<#
    homeiliora — start the local dev stack.

    Brings up MySQL and Apache (both from Laragon's binaries) and serves the
    site at http://localhost:8080. Safe to run twice: anything already
    running is left alone.

        powershell -ExecutionPolicy Bypass -File dev\start-local.ps1

    Stop everything again with dev\stop-local.ps1.
#>

$ErrorActionPreference = 'Stop'

$project = Split-Path -Parent $PSScriptRoot
$conf    = Join-Path $PSScriptRoot 'apache-homeiliora.conf'
$logDir  = Join-Path $PSScriptRoot 'logs'

$mysqld = 'C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqld.exe'
$httpd  = 'C:\laragon\bin\apache\httpd-2.4.66-260223-Win64-VS18\bin\httpd.exe'
$url    = 'http://localhost:8080'

if (-not (Test-Path $logDir)) { New-Item -ItemType Directory -Path $logDir | Out-Null }

foreach ($exe in @($mysqld, $httpd)) {
    if (-not (Test-Path $exe)) {
        Write-Host "Not found: $exe" -ForegroundColor Red
        Write-Host "Laragon has probably updated its bundled version. Correct the path here and in apache-homeiliora.conf." -ForegroundColor Yellow
        exit 1
    }
}
if (-not (Test-Path $conf)) { Write-Host "Missing config: $conf" -ForegroundColor Red; exit 1 }

# --- MySQL ----------------------------------------------------------------
if (Get-Process mysqld -ErrorAction SilentlyContinue) {
    Write-Host 'MySQL      already running'
} else {
    Start-Process -FilePath $mysqld -ArgumentList '--console' -WindowStyle Hidden
    Start-Sleep -Seconds 6
    if (Get-Process mysqld -ErrorAction SilentlyContinue) {
        Write-Host 'MySQL      started'
    } else {
        Write-Host 'MySQL      FAILED to start' -ForegroundColor Red; exit 1
    }
}

# --- Apache ---------------------------------------------------------------
if (Get-Process httpd -ErrorAction SilentlyContinue) {
    Write-Host 'Apache     already running'
} else {
    # Fail loudly on a bad config rather than exiting silently.
    & $httpd -f $conf -t
    if ($LASTEXITCODE -ne 0) { Write-Host 'Apache config is invalid.' -ForegroundColor Red; exit 1 }

    Start-Process -FilePath $httpd -ArgumentList '-f', "`"$conf`"" -WindowStyle Hidden
    Start-Sleep -Seconds 4
    if (Get-Process httpd -ErrorAction SilentlyContinue) {
        Write-Host 'Apache     started'
    } else {
        Write-Host 'Apache     FAILED to start — see dev\logs\apache-error.log' -ForegroundColor Red; exit 1
    }
}

# --- Confirm the site actually answers ------------------------------------
try {
    $r = Invoke-WebRequest -Uri $url -UseBasicParsing -TimeoutSec 25
    Write-Host ''
    Write-Host "Site is up: $url  (HTTP $($r.StatusCode))" -ForegroundColor Green
    Write-Host "Admin:      $url/wp-admin/"
} catch {
    Write-Host ''
    Write-Host "Processes are running but $url did not respond: $($_.Exception.Message)" -ForegroundColor Yellow
    Write-Host 'Check dev\logs\apache-error.log'
    exit 1
}
