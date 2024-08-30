# Define the directory containing the images
$imagesPath = "Laravel_Backend_api_for_app_web/public/images"

# Get the list of PNG and JPG files
$pngFiles = Get-ChildItem "$imagesPath" -Filter *.png
$jpgFiles = Get-ChildItem "$imagesPath" -Filter *.jpg

# Define the README file path
$readmePath = "$imagesPath/README.md"

# Initialize README content
$readmeContent = @"
# Image Gallery

## Website Images (Full Row)
"@

# Add PNG images with full row
foreach ($file in $pngFiles) {
    $fileName = $file.Name
    $filePath = "Laravel_Backend_api_for_app_web/public/images/$fileName"
    $readmeContent += "`n![Image: $fileName]($filePath)`n"
}

# Add section header for app images
$readmeContent += "`n## App Images (Three per Row)`n"
$readmeContent += "| Image | Image | Image |`n"
$readmeContent += "|-------|-------|-------|`n"

# Initialize counter for JPG images
$jpgCounter = 0
$imageRow = ""

# Add JPG images with three per row and include labels
foreach ($file in $jpgFiles) {
    $fileName = $file.Name
    $filePath = "Laravel_Backend_api_for_app_web/public/images/$fileName"
    $label = $fileName -replace ".jpg",""

    $imageRow += "| ![Image: $label]($filePath)<br>$label "

    $jpgCounter++

    # If counter is divisible by 3, complete the row and add it to the content
    if ($jpgCounter % 3 -eq 0) {
        $imageRow += "|`n"
        $readmeContent += $imageRow
        $imageRow = ""
    }
}

# If there are remaining images that do not complete a row, finalize that row
if ($jpgCounter % 3 -ne 0) {
    $remainingCells = 3 - ($jpgCounter % 3)
    for ($i = 0; $i -lt $remainingCells; $i++) {
        $imageRow += "| "
    }
    $imageRow += "|`n"
    $readmeContent += $imageRow
}

# Write content to README.md
$readmeContent | Out-File -FilePath $readmePath -Encoding UTF8

Write-Output "README.md file has been generated at $readmePath"
