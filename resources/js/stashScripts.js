var auxid = 0;

function printStashes(req) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200)) {
            var obj = JSON.parse(this.responseText);
            var result = '';
            obj.forEach((data) => {
                var auxname = data.name.toString();
                var auxloc = data.location.toString();
                result += `<tr>
                            <td class="align-middle">${data.id}</td>
                            <td class="align-middle">${data.name}</td>
                            <td class="align-middle">${data.location}</td>
                            <td class="align-middle">
                                <a href="/Inventorizer/fromStash/${data.id}/categories" class="btn btn-primary text-nowrap"
                                style="min-width: 120px;">
                                    <span class="material-icons float-right ml-1">category</span>Categories
                                </a>
                            </td>
                            <td class="align-middle">
                                <button type="button" data-toggle="modal" data-target="#modifyStash" class="btn btn-primary text-nowrap" style="min-width: 120px;" onclick="placeValues(${data.id},'${data.name}','${data.location}')">
                                    <span class="material-icons float-right ml-1">edit</span>Modify
                                </button>
                            </td>
                            </tr>`;
            });
            document.getElementById('tableResult').innerHTML = result;
        } else {
            document.getElementById('tableResult').innerHTML = 'No matches were found.';
        }
    };
    xhttp.open("GET", "./Controllers/searchStash.php?name="+req, true);
    xhttp.send();
}

function placeValues(id,name,loc){
    document.getElementById('InputChangeStashName').value = name;
    document.getElementById('InputChangeStashLocation').value = loc;
    auxid = id;
}

function sendToUpdate(name,loc) {
    if(document.getElementById('InputChangeStashName').value == ''){
        document.getElementById("invalidChangeStashName").hidden = false;
        document.getElementById('InputChangeStashName').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeStashLocation').value == '') {
        document.getElementById("invalidChangeStashLocation").hidden = false;
        document.getElementById('InputChangeStashLocation').classList.add("is-invalid");
    } else {
        document.getElementById("invalidChangeStashName").hidden = true;
        document.getElementById('InputChangeStashName').classList.remove("is-invalid");
        document.getElementById("invalidChangeStashLocation").hidden = true;
        document.getElementById('InputChangeStashLocation').classList.remove("is-invalid");
        window.location = "./Controllers/updateStash.php?id="+auxid+"&name="+name+"&location="+loc;
    }
}

function sendToCreate(name,loc) {
    if(document.getElementById('InputNewStashName').value == ''){
        document.getElementById("invalidNewStashName").hidden = false;
        document.getElementById('InputNewStashName').classList.add("is-invalid");
    } else if(document.getElementById('InputNewStashLocation').value == '') {
        document.getElementById("invalidNewStashLocation").hidden = false;
        document.getElementById('InputNewStashLocation').classList.add("is-invalid");
    } else {
        document.getElementById("invalidNewStashName").hidden = true;
        document.getElementById('InputNewStashName').classList.remove("is-invalid");
        document.getElementById("invalidNewStashLocation").hidden = true;
        document.getElementById('InputNewStashLocation').classList.remove("is-invalid");
        window.location = "./Controllers/createStash.php?name="+name+"&location="+loc;
    }  
}

function sendToDelete() {
    window.location = "./Controllers/deleteStash.php?id="+auxid;
}

document.addEventListener('DOMContentLoaded', ()=>{
    printStashes('');
});
