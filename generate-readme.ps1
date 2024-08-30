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
    $filePath = "images/$fileName"
    $readmeContent += "`n![Image: $fileName]($filePath)`n"
}

# Add section header for app images
$readmeContent += "`n## App Images (Three per Row)`n"

# Initialize counter for JPG images
$jpgCounter = 0

# Add JPG images with three per row
foreach ($file in $jpgFiles) {
    $fileName = $file.Name
    $filePath = "images/$fileName"
    $jpgCounter++
    
    $readmeContent += "![Image: $fileName]($filePath) "

    # If counter is divisible by 3, add a line break
    if ($jpgCounter % 3 -eq 0) {
        $readmeContent += "`n"
    }
}

# Write content to README.md
$readmeContent | Out-File -FilePath $readmePath -Encoding UTF8

Write-Output "README.md file has been generated at $readmePath"
