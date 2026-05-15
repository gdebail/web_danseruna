param(
  [string]$Root = "S:\"
)

$ErrorActionPreference = "Stop"
$jsonPath = Join-Path $Root "data\archive.editions.json"
$jsPath = Join-Path $Root "data\archive.editions.js"

if (!(Test-Path $jsonPath)) { throw "Missing $jsonPath" }

$data = Get-Content -Path $jsonPath -Raw | ConvertFrom-Json

# Generate JS fallback from single JSON source
$jsonRaw = $data | ConvertTo-Json -Depth 60
"window.DANSERUNA_ARCHIVE_DATA = $jsonRaw`r`n" | Set-Content -Path $jsPath -Encoding UTF8

# Sync per-edition meta.json files from the same source
foreach ($ed in $data.editions) {
  if (-not $ed.folder) { continue }
  $metaPath = Join-Path $Root ("assets\archive\editions\{0}\meta.json" -f $ed.folder)
  $metaObj = [ordered]@{
    year    = $ed.year
    edition = $ed.edition
    folder  = $ed.folder
    title   = $ed.title
    poster  = $ed.poster
    images  = @($ed.images)
    credits = @($ed.credits)
  }
  ($metaObj | ConvertTo-Json -Depth 30) | Set-Content -Path $metaPath -Encoding UTF8
}

Write-Output "Synced from single source: $jsonPath"
Write-Output "Generated: $jsPath"
