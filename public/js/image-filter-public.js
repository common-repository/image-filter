(function( $ ) {
  'use strict';

  $(document).ready(function() {

    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    let img = new Image();
    let fileName = "";

    const downloadBtn = document.getElementById("download-btn");
    const uploadFile = document.getElementById("upload-file");
    const revertBtn = document.getElementById("revert-btn");

    // Function to show loader
    function showLoader() {
      document.getElementById("loader").style.display = "block";
    }

    // Function to hide loader
    function hideLoader() {
      document.getElementById("loader").style.display = "none";
    }

    // Event listener for filter buttons
    document.addEventListener("click", e => {
      if (e.target.classList.contains("filter-btn")) {
        showLoader(); // Show loader before starting

        Caman("#canvas", img, function() {
          if (e.target.classList.contains("brightness-add")) {
            this.brightness(5);
          } else if (e.target.classList.contains("brightness-remove")) {
            this.brightness(-5);
          } else if (e.target.classList.contains("contrast-add")) {
            this.contrast(5);
          } else if (e.target.classList.contains("contrast-remove")) {
            this.contrast(-5);
          } else if (e.target.classList.contains("saturation-add")) {
            this.saturation(5);
          } else if (e.target.classList.contains("saturation-remove")) {
            this.saturation(-5);
          } else if (e.target.classList.contains("vibrance-add")) {
            this.vibrance(5);
          } else if (e.target.classList.contains("vibrance-remove")) {
            this.vibrance(-5);
          } else if (e.target.classList.contains("vintage-add")) {
            this.vintage();
          } else if (e.target.classList.contains("lomo-add")) {
            this.lomo();
          } else if (e.target.classList.contains("clarity-add")) {
            this.clarity();
          } else if (e.target.classList.contains("sincity-add")) {
            this.sinCity();
          } else if (e.target.classList.contains("crossprocess-add")) {
            this.crossProcess();
          } else if (e.target.classList.contains("pinhole-add")) {
            this.pinhole();
          } else if (e.target.classList.contains("nostalgia-add")) {
            this.nostalgia();
          } else if (e.target.classList.contains("hermajesty-add")) {
            this.herMajesty();
          }

          // Render and complete processing
          this.render(function() {
            hideLoader(); // Hide loader after processing is complete
          });
        });
      }
    });

    // Revert Filters
    revertBtn.addEventListener("click", e => {
      Caman("#canvas", img, function() {
        this.revert();
      });
    });

    // Upload File
    uploadFile.addEventListener("change", () => {
      // Get File
      const file = document.getElementById("upload-file").files[0];
      // Init FileReader API
      const reader = new FileReader();

      // Check for file
      if (file) {
        // Set file name
        fileName = file.name;
        // Read data as URL
        reader.readAsDataURL(file);
      }

      // Add image to canvas
      reader.addEventListener(
        "load",
        () => {
          // Create image
          img = new Image();
          // Set image src
          img.src = reader.result;
          // On image load add to canvas
          img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0, img.width, img.height);
            canvas.removeAttribute("data-caman-id");
            hideLoader(); // Hide loader after the image is loaded
          };
        },
        false
      );
    });

    // Download Event
    downloadBtn.addEventListener("click", () => {
      // Get ext
      const fileExtension = fileName.slice(-4);

      // Init new filename
      let newFilename;

      // Check image type
      if (fileExtension === ".jpg" || fileExtension === ".png") {
        // new filename
        newFilename = fileName.substring(0, fileName.length - 4) + "-edited.jpg";
      }

      // Call download
      download(canvas, newFilename);
    });

    // Download function
    function download(canvas, filename) {
      // Init event
      let e;
      // Create link
      const link = document.createElement("a");

      // Set props
      link.download = filename;
      link.href = canvas.toDataURL("image/jpeg", 0.8);
      // New mouse event
      e = new MouseEvent("click");
      // Dispatch event
      link.dispatchEvent(e);
    }

  });

})( jQuery );
