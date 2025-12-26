
    function tandaiSemua() {
        fetch('/notifikasi/markAll', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(res => {
            console.log(res.success);
            console.log(res.ok);
            return res.json();
        }).then(location.reload());
    }
</script>