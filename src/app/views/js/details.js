window.onload = function(){

    // Compartir Toast
    document.querySelector('.bi-share').addEventListener('click', async () => {
        try {
        const urlToCopy = window.location.href;
        await navigator.clipboard.writeText(urlToCopy);
        const toastEl = document.getElementById('copyToast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
        } catch (err) {
        alert('Error al copiar al portapapeles');
        console.error(err);
        }
    });

}