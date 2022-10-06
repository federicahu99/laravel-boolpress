const imgPrev=document.getElementById('preview');
const imgUrl=document.getElementById('image');
const placeholder='https://storage.googleapis.com/proudcity/mebanenc/uploads/2021/03/placeholder-image-300x225.png';


imgUrl.addEventListener('input', () => {
    // if(imgUrl.value) imgPrev.src= imgUrl.value;
    // else imgPrev.src= placeholder;
    if(imgUrl.files && imgUrl.files[0]) {
        let reader = new FileReader();

        reader.readAsDataURL(imgUrl.files[0]);
        reader.onload = event => {
            imgPrev.src = event.target.result;
        }//leggi il file ed eseguisci
    } else imgPrev.src = placeholder;
})
