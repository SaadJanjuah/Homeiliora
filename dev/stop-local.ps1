<#
    homeiliora — stop the local dev stack.

        powershell -ExecutionPolicy Bypass -File dev\stop-local.ps1

    Note this stops EVERY mysqld/httpd process on the machine, not only the
    ones start-local.ps1 launched. That is fine here because the stack is
    started on demand rather than run as a Windows service — but if you ever
    run another local site at the same time, stop that one first.
#>

foreach ($name in @('httpd', 'mysqld')) {
    $procs = Get-Process $name -ErrorAction SilentlyContinue
    if ($procs) {
        $procs | Stop-Process -Force
        Write-Host ("{0,-10} stopped ({1} process(es))" -f $name, $procs.Count)
    } else {
        Write-Host ("{0,-10} not running" -f $name)
    }
}
