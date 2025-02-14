import './bootstrap';

let buttonLike = document.querySelectorAll('.likeButton');
buttonLike.forEach((elem)=>{
    elem.addEventListener('click', ()=>{
        let id = elem.getAttribute('data-id')
        // отправить запрос fetch на addLike
        axios.post(`/posts/${id}/add/like`)
            .then(response => {
                document.getElementById('likeCount').textContent = response.data.likes
            })
            .catch(error => {
                console.error('Error: ', error.response.message)
            });
        // получить ответ и отобразить лайки или ошибку
    })
});
