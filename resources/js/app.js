import './bootstrap';
import 'flowbite';


const logout = document.querySelector( '#logout' );
if( logout ) {
    console.log('ыфдге,')
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
