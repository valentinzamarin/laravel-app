import './bootstrap';
import 'flowbite';


const logout = document.querySelector( '#logout' );
if( logout ) {
    logout.addEventListener( 'click', (e) => {
        e.preventDefault();

        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    })
}

const deletePostBtn = document.querySelector( '#delete' );
if( deletePostBtn ) {

    deletePostBtn.addEventListener( 'click', (e) => {
        e.preventDefault();
        let post_id = e.target.dataset.post;
        fetch(`/post/${post_id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (response.ok) {
                    window.location.href = '/';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    })
}
