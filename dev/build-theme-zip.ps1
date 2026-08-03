<#
    Build a WordPress-installable zip of the moodboard theme.

    Not Compress-Archive: on Windows PowerShell 5.1 it writes entry paths with
    BACKSLASHES, which the ZIP spec forbids (it requires "/"). WordPress's
    unzip then either fails or creates files with literal backslashes in their
    names instead of folders. Entries are written explicitly here so the
    archive is portable.
#>

param(
    [string]$Source = 'c:\Saad VIBE Coding\saad-site\wp-content\themes\moodboard',
    [string]$Out    = 'c:\Saad VIBE Coding\moodboard-theme.zip'
)

$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

if (Test-Path $Out) { Remove-Item $Out -Force }

$root     = (Get-Item $Source).FullName.TrimEnd('\')
$rootName = Split-Path $root -Leaf
$zip      = [System.IO.Compression.ZipFile]::Open($Out, 'Create')

try {
    Get-ChildItem -Path $root -Recurse -File | ForEach-Object {
        # Path relative to the theme folder, prefixed with the theme folder
        # name so the archive unpacks to wp-content/themes/moodboard/.
        $rel   = $_.FullName.Substring($root.Length + 1) -replace '\\', '/'
        $entry = "$rootName/$rel"
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile(
            $zip, $_.FullName, $entry, [System.IO.Compression.CompressionLevel]::Optimal
        ) | Out-Null
    }
} finally {
    $zip.Dispose()
}

$size = [math]::Round((Get-Item $Out).Length / 1KB, 1)
Write-Host "Built $Out ($size KB)"

# Prove the structure is what WordPress expects.
$check = [System.IO.Compression.ZipFile]::OpenRead($Out)
$bad   = @($check.Entries | Where-Object { $_.FullName -match '\\' })
$has   = @($check.Entries | Where-Object { $_.FullName -eq "$rootName/style.css" }).Count -eq 1
Write-Host "entries:            $($check.Entries.Count)"
Write-Host "backslash entries:  $($bad.Count)   (must be 0)"
Write-Host "$rootName/style.css: $(if ($has) { 'present' } else { 'MISSING' })"
$check.Dispose()
