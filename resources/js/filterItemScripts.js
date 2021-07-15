var auxid = 0;

function printItems(req,catid) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 200)) {
            var obj = JSON.parse(this.responseText);
            var result = '';
            obj.forEach((data) => {
                result += `<tr>
                            <td class="align-middle">${data.id}</td>
                            <td class="align-middle" style="color: #2A9D8F; cursor: pointer;" data-toggle="modal" data-target="#itemDescription" onclick="placeDescription('${data.name}','${data.description}')">${data.name}</td>
                            <td class="align-middle">${data.category}</td>
                            <td class="align-middle">${data.quantity}</td>
                            <td class="align-middle">${data.status}</td>
                            <td class="align-middle">
                                <button type="button" data-toggle="modal" data-target="#modifyItem" onclick="placeValues(${data.id},'${data.name}',${data.category},'${data.description}',${data.quantity},'${data.status}')" 
                                    class="btn btn-primary text-nowrap" style="min-width: 120px;">
                                    <span class="material-icons float-right ml-1">edit</span>Modify
                                </button>
                            </td>
                        </tr>`;
            });
            document.getElementById('tableResultFI').innerHTML = result;
        } else {
            document.getElementById('tableResultFI').innerHTML = 'No matches were found.';
        }
    };
    xhttp.open("GET", "/Inventorizer/Controllers/filterItem.php?category="+catid+"&name="+req, true);
    xhttp.send();
}

function placeDescription(title,text){
    document.getElementById('DescriptionTitle').innerHTML = title+" Details";
    document.getElementById('itemDetails').innerHTML = text;
}

function fillCategorySelect(){
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
            document.getElementById('InputChangeItemCategory').innerHTML = Cfiller;
            document.getElementById('InputNewItemCategory').innerHTML = Nfiller;
        }
    };
    xhttp.open("GET", "/Inventorizer/Controllers/searchCategory.php?name=", true);
    xhttp.send();
}

function placeValues(id,name,category,description,quantity,status){
    document.getElementById('InputChangeItemName').value = name;
    document.getElementById('InputChangeItemCategory').value = category;
    document.getElementById('InputChangeItemDescription').value = description;
    document.getElementById('InputChangeItemQuantity').value = quantity;
    document.getElementById('InputChangeItemStatus').value = status;
    auxid = id;
}

function sendToUpdate(name,category,description,quantity,status,catid) {
    if(document.getElementById('InputChangeItemName').value == ''){
        document.getElementById("invalidChangeItemName").hidden = false;
        document.getElementById('InputChangeItemName').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeItemCategory').value == '...') {
        document.getElementById("invalidChangeItemCategory").hidden = false;
        document.getElementById('InputChangeItemCategory').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeItemDescription').value == '') {
        document.getElementById("invalidChangeItemDescription").hidden = false;
        document.getElementById('InputChangeItemDescription').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeItemQuantity').value == '') {
        document.getElementById("invalidChangeItemQuantity").hidden = false;
        document.getElementById('InputChangeItemQuantity').classList.add("is-invalid");
    } else if(document.getElementById('InputChangeItemStatus').value == '...') {
        document.getElementById("invalidChangeItemStatus").hidden = false;
        document.getElementById('InputChangeItemStatus').classList.add("is-invalid");
    } else {
        document.getElementById("invalidChangeItemName").hidden = true;
        document.getElementById('InputChangeItemName').classList.remove("is-invalid");
        document.getElementById("invalidChangeItemCategory").hidden = true;
        document.getElementById('InputChangeItemCategory').classList.remove("is-invalid");
        document.getElementById("invalidChangeItemDescription").hidden = true;
        document.getElementById('InputChangeItemDescription').classList.remove("is-invalid");
        document.getElementById("invalidChangeItemQuantity").hidden = true;
        document.getElementById('InputChangeItemQuantity').classList.remove("is-invalid");
        document.getElementById("invalidChangeItemStatus").hidden = true;
        document.getElementById('InputChangeItemStatus').classList.remove("is-invalid");
        window.location = "/Inventorizer/Controllers/updateItem.php?id="+auxid+"&name="+name+"&category="+category+"&description="+description+"&quantity="+quantity+"&status="+status+"&filter="+catid;
    }
}

function sendToCreate(name,category,description,quantity,status,catid) {
    if(document.getElementById('InputNewItemName').value == ''){
        document.getElementById("invalidNewItemName").hidden = false;
        document.getElementById('InputNewItemName').classList.add("is-invalid");
    } else if(document.getElementById('InputNewItemCategory').value == '...') {
        document.getElementById("invalidNewItemCategory").hidden = false;
        document.getElementById('InputNewItemCategory').classList.add("is-invalid");
    } else if(document.getElementById('InputNewItemDescription').value == '') {
        document.getElementById("invalidNewItemDescription").hidden = false;
        document.getElementById('InputNewItemDescription').classList.add("is-invalid");
    } else if(document.getElementById('InputNewItemQuantity').value == '') {
        document.getElementById("invalidNewItemQuantity").hidden = false;
        document.getElementById('InputNewItemQuantity').classList.add("is-invalid");
    } else if(document.getElementById('InputNewItemStatus').value == '...') {
        document.getElementById("invalidNewItemStatus").hidden = false;
        document.getElementById('InputNewItemStatus').classList.add("is-invalid");
    } else {
        document.getElementById("invalidNewItemName").hidden = true;
        document.getElementById('InputNewItemName').classList.remove("is-invalid");
        document.getElementById("invalidNewItemCategory").hidden = true;
        document.getElementById('InputNewItemCategory').classList.remove("is-invalid");
        document.getElementById("invalidNewItemDescription").hidden = true;
        document.getElementById('InputNewItemDescription').classList.remove("is-invalid");
        document.getElementById("invalidNewItemQuantity").hidden = true;
        document.getElementById('InputNewItemQuantity').classList.remove("is-invalid");
        document.getElementById("invalidNewItemStatus").hidden = true;
        document.getElementById('InputNewItemStatus').classList.remove("is-invalid");
        window.location = "/Inventorizer/Controllers/createItem.php?name="+name+"&category="+category+"&description="+description+"&quantity="+quantity+"&status="+status+"&filter="+catid;
    }   
}

function sendToDelete(catid) {
    window.location = "/Inventorizer/Controllers/deleteItem.php?id="+auxid+"&filter="+catid;
}

document.addEventListener('DOMContentLoaded', ()=>{
    printItems(document.getElementById('InputFItem').value,document.getElementById('var1').innerHTML);
    fillCategorySelect();
});
