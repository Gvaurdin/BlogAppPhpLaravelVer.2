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


document.addEventListener('DOMContentLoaded', function () {
    function deleteEntity(id, entityName, entityTitle) {
        if (confirm(`Вы уверены, что хотите удалить ${entityName} "${entityTitle}"?`)) {
            const form = document.getElementById('delete-form-' + id);
            if (form) {
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.success);
                            const entityRow = form.closest('li');
                            if (entityRow) {
                                entityRow.remove();
                            }
                        } else {
                            alert(data.error);
                        }
                    })
                    .catch(error => {
                        alert('Ошибка: ' + error);
                    });
            } else {
                console.log('Форма с ID "delete-form-' + id + '" не найдена!');
                alert('Ошибка: форма не найдена.');
            }
        }
    }

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const entityName = this.getAttribute('data-entity') || 'элемент';
            const entityTitle = this.getAttribute('data-name') || '';
            deleteEntity(id, entityName, entityTitle);
        });
    });
});










