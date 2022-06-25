//https://stackoverflow.com/questions/21070101/show-hide-div-using-javascript

// diverese deklarationen für die funktionen
const overlay = document.getElementById("overlay");
overlay.style.display = 'none';

const chatarea = document.getElementById("chatarea");

const chatlist = document.getElementById("chatlist");

const chatnum = document.getElementById("chatnum");

const username = document.getElementById("username").innerText;



var chatname;

function chatareaedit(action){
//neues request-Objekt
    var request = new XMLHttpRequest();
//Initialisieren von POST an iframe.php, Einbindung des Inputs über htmlspecialchars (siehe iframe.php)
    request.open("POST", "iframes.php?action=" + action, true);
//sendet Request
    request.send();
//Übernahme des Ergebnisses in das HTML (mit innerHTML), wenn request "fertig" + Anotwork = 200(OK)
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chatarea.innerHTML = this.responseText;
            chatarea.style.display = 'initial';
        }
    };
}



//
function chatlistedit(){
    var request = new XMLHttpRequest();
    request.open("POST", "c.php", true);
    request.send();
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chatlist.innerHTML = this.responseText;
        }
    };
    mainchatlist();
}
chatlistedit();
function mainchatlist(){
    setTimeout(chatlistedit, 30000);
}

function chatsedit(chat){
//neues request-Objekt
    var request = new XMLHttpRequest();

    request.open("POST", "cview.php?chat=" + chat, true);
//sendet Request
    request.send();

    request.onreadystatechange = function(){
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chatarea.innerHTML = this.responseText;
            chatarea.style.display = 'initial';
            //https://stackoverflow.com/questions/270612/scroll-to-bottom-of-div
            var objDiv = document.getElementById("messages");
            objDiv.scrollTop = objDiv.scrollHeight;
        }
    };
}

function sendmsg(chatid, uid, chatname){
    //zeitstempel hinzufügen
    var today = new Date();
    var date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes();
    var dateTime = date+'   @'+time;

    let msg = document.getElementById("msginput").value;
    document.getElementById("msginput").value = "";

    msg = '<span class="date">'+username + ", " + dateTime +"</span>"+"<br>"+'<span class="message">'+msg+"</span>";
    msg = encodeURIComponent(msg);

    var request = new XMLHttpRequest();

    request.open("POST", "send.php?roomid=" + chatid + "&uid=" + uid, true);
    request.setRequestHeader("msg", msg);
    request.send();

    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if(this.responseText == 1){
                chatsedit(chatname);
                
            }

        }
    };
}

function memberedit(roomid){
    var request = new XMLHttpRequest();
    request.open("POST", "manage.php?roomid=" + roomid, true);
    request.send();
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chatarea.innerHTML = this.responseText;
        }
    };
}

function chatremove(roomid, uid){
    var request = new XMLHttpRequest();
    request.open("POST", "remove.php?roomid=" + roomid + "&uid=" + uid, true);
    request.send();
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            if(this.responseText == 1){
                memberedit(roomid);
            }
        }
    };    
}
function addexec(roomid){
    const addinput = document.getElementById("addinput").value;
    var request = new XMLHttpRequest();
    request.open("POST", "add.php?roomid=" + roomid + "&uname=" + addinput, true);
    request.send();
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
           if(this.responseText == 1){
                memberedit(roomid);
            } 
        }
    };    
}

function settings(){
    var request = new XMLHttpRequest();
    request.open("POST", "settings.php", true);
    request.send();
    request.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            chatarea.innerHTML = this.responseText;

        }
    };    
}

//https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/Ajax-JavaScript-file-upload-example
async function uploadFile() {
  let formData = new FormData(); 
  formData.append("file", fileupload.files[0]);
  await fetch('upload.php', {
    method: "POST", 
    body: formData
  }); 
  alert('Your profile picture uploaded successfully.');
}
