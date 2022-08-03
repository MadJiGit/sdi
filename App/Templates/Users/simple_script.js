
    function myFunction(a) {

        alert("tesstttt");

        let p = document.getElementById(a);
        if (p.type === "password") {
            p.type = "text";
        } else {
            p.type = "password";
        }
    }