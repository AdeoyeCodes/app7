<?php 

include 'head.php';
include 'header.php';

?>

<body style="background-color: black;">
    <div class="container" style="background-color: black; margin-top: 10px; margin-left: 0dvh;">
        <img src="assets/phones.png" style="width: 60%;" />
    </div>

    <div class="container">
        <form id="uploadForm" action="db3.php" method="post" enctype="multipart/form-data">
            <h3 style= "color: orange; text-align: center; margin-top: 6dvh;"> SELECT YOUR MUSIC </h3>
            <p style= "color: yellow;"> MAX FILE SIZE: <b>2MB</b> </p>
            <input type="file" class="form-control" name="music" id="music" placeholder="Choose a music file..."
                accept=".mp3, .wav, .ogg"  required/><br /><br />

            <h3 style= "color: orange; text-align: center;"> Your Thumbnail </h3>
            <input type="file" class="form-control" name="picture" id="picture" placeholder="Choose an image file..."
                accept=".png, .jpg, .jpeg, .gif" required />

            <button id="uploadBtn" class="btn btn-info" style= "margin-top: 5dvh;"> Upload </button>
        </form>
    </div>

    <div id="progressContainer" style="display: none; text-align: center;">
     <progress id="progressBar" style= "width: 80%; height: 20px; margin: 20px auto;" value="0" max="100"></progress>
    </div>

    <div id="resultContainer" style="margin-top: 10vh; padding-bottom: 20dvh; background: 
    background-color: orange;"></div>
</body>
<script>
    $(document).ready(function () {
        $("#uploadBtn").on("click", function (e) {
            e.preventDefault();

            var form = $("#uploadForm")[0];
            var formData = new FormData(form);

            // Display the progress bar
            $("#progressContainer").show();

            $.ajax({
                type: "POST",
                url: "db3.php",
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $("#progressBar").val(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                    // Hide the progress bar after upload
                    $("#progressContainer").hide();

                    console.log(response);

                    if (response.success) {
                        console.log("Success! Music:", response.musicFileName, "Picture:", response.pictureFileName);
                        form.reset();

                        var resultContainer = $("#resultContainer");
                        var thumbnailDiv = $("<div>");

                        if (response.pictureFileName) {
                            var thumbnailImg = $("<img>", {
                                src: "uploads/images/" + response.pictureFileName,
                                alt: "Thumbnail",
                                style: "width: 150px; height: 150px; margin-right: 10px; border-radius: 10px;"
                            });
                            thumbnailDiv.append(thumbnailImg);
                        }

                        if (response.musicFileName) {
                            var audioPlayer = $("<audio>", {
                                controls: "controls",
                                style: "width: 300px;"
                            });
                            var source = $("<source>", {
                                src: "uploads/music/" + response.musicFileName,
                                type: "audio/mpeg"
                            });

                            audioPlayer.append(source);
                            thumbnailDiv.append(audioPlayer);
                        }

                        resultContainer.empty().append(thumbnailDiv);
                    } else {
                        console.log("Error:", response.error);
                        alert("Error uploading files. Please try again. Details: " + response.error);
                    }
                },
                error: function () {
                    // Hide the progress bar on error
                    $("#progressContainer").hide();
                    alert("An unexpected error occurred. Please try again.");
                }
            });
        });

        function playMusic(musicUrl) {
            var audio = new Audio(musicUrl);
            audio.play();
        }
    });
</script>


</body> 


<?php 

include 'footer.php';

?>