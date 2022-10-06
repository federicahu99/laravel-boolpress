const imgPrev=document.getElementById('preview');
const imgUrl=document.getElementById('image');
const placeholder='https://storage.googleapis.com/proudcity/mebanenc/uploads/2021/03/placeholder-image-300x225.png';


imgUrl.addEventListener('input', () => {
    // if(imgUrl.value) imgPrev.src= imgUrl.value;
    // else imgPrev.src= placeholder;

    imgPrev.src = imgUrl.value || placeholder;
})
