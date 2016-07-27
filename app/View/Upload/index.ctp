<<<<<<< .mine
<form action="Upload/upload" method="POST" enctype="multipart/form-data">
    <input name="fileToUpload" id="imgInp" onchange='GotFile(this)' type="file" accept="image/*"/>
    <img id="blah" height='100' width='100' src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Face-grin.svg/2000px-Face-grin.svg.png" alt="your image" />
    <br/>
    <input type="submit" value="Submit image"/>
</from>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                
                document.getElementById("blah").src = e.target.result;//"https://www.ohayfile.com/content/2015/07/woman-minions-wallpaper-hd-ohay-tv-82466.jpg";
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
function GotFile(ctl)
{
    // alert("hola");
    readURL(ctl);
}
</script>||||||| .r8

=======
<input></<input>
>>>>>>> .r11
