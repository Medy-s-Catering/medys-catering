docker compose up -d @args

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "  App        http://localhost:8080"
    Write-Host "  Database   localhost:5433  (db: medys_catering  user: medys  pass: medys)"
    Write-Host ""
}
