var auxid = 0;

function printCategories(req,stid) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200)) {
            var obj = JSON.parse(this.responseText);
            var result = '';
            obj.forEach((data) => {
                result += `<tr>
                            <td class="align-middle">${data.id}</td>
                            <td class="align-middle">${data.name}</td>
                            <td class="align-middle">${data.stash}</td>
                            <td class="align-middle">
                                <a href="/Inventorizer/fromCategory/${data.id}/items" class="btn btn-primary text-nowrap"
                                style="min-width: 120px;">
                                    <span class="material-icons float-right ml-1">view_in_ar</span>Items
                                </a>
                            </td>
                            <td class="align-middle">
                                <button type="button" data-toggle="modal" data-target="#modifyCategory" onclick="placeValues(${data.id},'${data.name}',${data.stash})" 
                                    class="btn btn-primary text-nowrap" style="min-width: 120px;">
                                    <span class="material-icons float-right ml-1">edit</span>Modify
                                </button>
                            </td>
                        </tr>`;
            });
            document.getElementById('tableResultFC').innerHTML = result;
        } else {
            document.getElementById('tableResultFC').innerHTML = 'No matches were found.';
        }
    };
    xhttp.open("GET", "/Inventorizer/Controllers/filterCategory.php?stash="+stid+"&name="+req, true);
    xhttp.send();
}

function fillStashSelect(){
    var Cfiller = `<option>...</option>`;
    var Nfiller = `<option selected>...</option>`;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200)) {
            var obj = JSON.parse(this.responseText);
            obj.forEach((data) => {
                Cfiller += `<option>${data.id}</option>`;
                Nfiller += `<option>${data.id}</option>`;
            });
            document.getElementById('InputChangeCategoryStash').innerHTML = Cfiller;
            document.getElementById('InputNewCategoryStash').innerHTML = Nfiller;
        }
    };
    xhttp.open("GET", "/Inventorizer/Controllers/searchStash.php?name=", true);
    xhttp.send();
}

function placeValues(id,name,stash){
    document.getElementById('InputChangeCategoryName').value = name;
    document.getElementById('InputChangeCategoryStash').value = stash;
    auxid = id;
}

function sendToUpdate(name,stash,stid) {
    if(document.getElementById('InputChangeCategoryName').value == ''){
        document.getElementById("invalidChangeCategoryName").hidden = false;
        document.getElementById('InputChangeCategoryName').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeCategoryStash').value == '...') {
        document.getElementById("invalidChangeCategoryStash").hidden = false;
        document.getElementById('InputChangeCategoryStash').classList.add("is-invalid");
    } else {
        document.getElementById("invalidChangeCategoryName").hidden = true;
        document.getElementById('InputChangeCategoryName').classList.remove("is-invalid");
        document.getElementById("invalidChangeCategoryStash").hidden = true;
        document.getElementById('InputChangeCategoryStash').classList.remove("is-invalid");
        window.location = "/Inventorizer/Controllers/updateCategory.php?id="+auxid+"&name="+name+"&stash="+stash+"&filter="+stid;
    }
}

function sendToCreate(name,stash,stid) {
    if(document.getElementById('InputNewCategoryName').value == ''){
        document.getElementById("invalidNewCategoryName").hidden = false;
        document.getElementById('InputNewCategoryName').classList.add("is-invalid");
    } else if(document.getElementById('InputNewCategoryStash').value == '...') {
        document.getElementById("invalidNewCategoryStash").hidden = false;
        document.getElementById('InputNewCategoryStash').classList.add("is-invalid");
    } else {
        document.getElementById("invalidNewCategoryName").hidden = true;
        document.getElementById('InputNewCategoryName').classList.remove("is-invalid");
        document.getElementById("invalidNewCategoryStash").hidden = true;
        document.getElementById('InputNewCategoryStash').classList.remove("is-invalid");
        window.location = "/Inventorizer/Controllers/createCategory.php?name="+name+"&stash="+stash+"&filter="+stid;
    }    
}

function sendToDelete(stid) {
    window.location = "/Inventorizer/Controllers/deleteCategory.php?id="+auxid+"&filter="+stid;
}

document.addEventListener('DOMContentLoaded', ()=>{
    printCategories(document.getElementById('InputFCategory').value,document.getElementById('var1').innerHTML);
    fillStashSelect();
});
