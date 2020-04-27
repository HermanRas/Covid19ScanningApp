let timerInterval
Swal.fire({
    title: 'Alert!',
    html: 'This Employee has already been scanned.',
    timer: 5000,
    timerProgressBar: true,
    onBeforeOpen: () => {
        Swal.showLoading()
        timerInterval = setInterval(() => {
            const content = Swal.getContent()
            if (content) {
                const b = content.querySelector('b')
                if (b) {
                    b.textContent = Swal.getTimerLeft()
                }
            }
        }, 100)
    },
    onClose: () => {
        clearInterval(timerInterval)
    }
}).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
    }
})