window.onload = function () {
    document.getElementById("technical").onclick = function () {
        document.getElementById("technical_description").style.display = "block";
        document.getElementById("functional_description").style.display = "none";
        var btn = document.getElementsByClassName("functional")[0];
        btn.className = btn.className.replace("active", "");
        this.className += " active";
    }
    document.getElementById("functional").onclick = function () {
        document.getElementById("functional_description").style.display = "block";
        document.getElementById("technical_description").style.display = "none";
        var btn = document.getElementsByClassName("technical")[0];
        this.className += " active";
        btn.className = btn.className.replace("active", "");
    }
}
