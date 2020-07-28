function logout() {
    $.ajax({
        url: 'actions/logout.php',
        method: 'POST',
        success: function(res) {
            window.location = 'index.php';
        },
        error: function(res) {
            console.log(res);
        }
    });
}
