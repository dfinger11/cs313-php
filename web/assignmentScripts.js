function hamburgerFunction(x) {
    x.classList.toggle("change");
    var y = document.getElementById("accContainer");
    if (y.style.display === "block") {
        y.style.display = "none";
    } else {
        y.style.display = "block";
    }
}

document.getElementById("homeButton").onclick = function goHome() {
    location.href = "homepage.php";
};