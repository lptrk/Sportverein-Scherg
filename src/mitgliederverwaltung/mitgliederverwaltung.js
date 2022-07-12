
function showModal() {

    document.getElementById("edit-div").style.display = "block";
    document.getElementsByClassName("container-div").style.webkitFilter= "blur(1px)";
}

function closeModal(){

    document.getElementById("edit-div").style.display = "none";
    document.getElementById("body").style.webkitFilter="blur(0px)"

}

function openAddModal(){
    document.getElementById("add-div").style.display="block"
}

function closeAddModal(){
    document.getElementById("add-div").style.display ="none"
}