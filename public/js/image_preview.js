const inputFile = document.getElementById("image_url");
const container = document.getElementById("preview");
const image = container.querySelector(".img_preview");
const text_preview = image.querySelector(".text_preview");

inputFile.addEventListener('change', function() {
    const file = this.files[0];
    console.log(file);
    if(file){
        const reader = new FileReader();
        // text_preview.style.display = "none";
        image.style.display = "block";
        reader.addEventListener("load", function() {
            image.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    }else{
        image.style.display = null;
    }
});