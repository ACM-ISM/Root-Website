// form validation function //
function validate_login(form) {
  var username = form.user_name.value;
  if(username == "") {
    inlineMsg('user_name','You must enter your username.',2);
    return false;
  }
  var usernameRegex = /^[a-z]{1}[a-z0-9_]{3,13}$/;
  if(!username.match(usernameRegex)) {
    inlineMsg('user_name','You have entered an invalid username.',2);
    return false;
  }
}
function validate_signup(form) {
  var name = form.name.value;
  var username = form.username.value;
  var email = form.email.value;
  var spoj = form.spoj.value;
  var hackerrank = form.hackerrank.value;
  var codechef = form.codechef.value;
  var admission = form.admission.value;
  var phone = form.phone_number.value;
  var branch = form.branch.value;
  var member = form.member.value;
  var nameRegex = /^[a-zA-Z ]{3,20}$/;
  var usernameRegex = /^[a-z]{1}[a-z0-9_]{3,13}$/;
  var memberRegex = /^[0-9]{4,8}$/;
  var spojRegex = /^[a-z]{1}[a-z0-9_]{2,13}$/;
  var codechefRegex = /^[a-z]{1}[a-z0-9_]{3,13}$/;
  var hackerrankRegex = /^[a-zA-Z0-9_]{5,16}$/;
  var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  var admissionRegex = /^[2]{1}[0-1]{2}[0-9]{1}[a-zA-Z]{2}[0-9]{4}$/;
  var phoneRegex = /^[7-9]{1}[0-9]{9}/;
  if(name == "") {
    inlineMsg('name','You must enter your name.',2);
    return false;
  }
  if(!name.match(nameRegex)) {
    inlineMsg('name','You have entered an invalid name.',2);
    return false;
  }
  if(username == "") {
    inlineMsg('username','You must enter your username.',2);
    return false;
  }
  if(!username.match(usernameRegex)) {
    inlineMsg('username','You have entered an invalid username./^[a-z]{1}[a-z0-9_]{3,13}$/',2);
    return false;
  }
  if(email == "") {
    inlineMsg('email','<strong>Error</strong><br />You must enter your email.',2);
    return false;
  }
  if(!email.match(emailRegex)) {
    inlineMsg('email','<strong>Error</strong><br />You have entered an invalid email.',2);
    return false;
  }
  if(spoj == "") {
    inlineMsg('spoj','You must enter your spoj username.',2);
    return false;
  }
  if(!spoj.match(spojRegex)) {
    inlineMsg('spoj','You have entered an invalid spoj username./^[a-z]{1}[a-z0-9_]{2,13}$/',2);
    return false;
  }
  if(codechef == "") {
    inlineMsg('codechef','You must enter your codechef username.',2);
    return false;
  }
  if(!codechef.match(codechefRegex)) {
    inlineMsg('codechef','You have entered an invalid codechef username./^[a-z]{1}[a-z0-9_]{3,13}',2);
    return false;
  }
  if(hackerrank == "") {
    inlineMsg('hackerrank','You must enter your hackerrank username.',2);
    return false;
  }
  if(!hackerrank.match(hackerrankRegex)) {
    inlineMsg('hackerrank','You have entered an invalid hackerrank username./^[a-zA-Z0-9_]{5,16}$/',2);
    return false;
  }
  if(admission == "") {
    inlineMsg('admission','You must enter your admission number.',2);
    return false;
  }
  if(!admission.match(admissionRegex)) {
    inlineMsg('admission','You have entered an invalid admission number.',2);
    return false;
  }
  if(member == "") {
    inlineMsg('member','You must enter your admission number.',2);
    return false;
  }
  if(!member.match(memberRegex)) {
    inlineMsg('member','You have entered an invalid admission number.',2);
    return false;
  }
  if(batch == "") {
    inlineMsg('batch','You must enter your batch.',2);
    return false;
  }
  if(branch == "") {
    inlineMsg('branch','You must enter your branch.',2);
    return false;
  }
  if(phone == "") {
    inlineMsg('phone_number','You must enter your phone number.',2);
    return false;
  }
  if(!phone.match(phoneRegex)) {
    inlineMsg('phone_number','You have entered an invalid phone number.',2);
    return false;
  }
  return true;
}

// START OF MESSAGE SCRIPT //

var MSGTIMER = 20;
var MSGSPEED = 5;
var MSGOFFSET = 3;
var MSGHIDE = 3;

// build out the divs, set attributes and call the fade function //
function inlineMsg(target,string,autohide) {
  var msg;
  var msgcontent;
  if(!document.getElementById('msg')) {
    msg = document.createElement('div');
    msg.id = 'msg';
    msgcontent = document.createElement('div');
    msgcontent.id = 'msgcontent';
    document.body.appendChild(msg);
    msg.appendChild(msgcontent);
    msg.style.filter = 'alpha(opacity=0)';
    msg.style.opacity = 0;
    msg.alpha = 0;
  } else {
    msg = document.getElementById('msg');
    msgcontent = document.getElementById('msgcontent');
  }
  msgcontent.innerHTML = string;
  msg.style.display = 'block';
  var msgheight = msg.offsetHeight;
  var targetdiv = document.getElementById(target);
  targetdiv.focus();
  var targetheight = targetdiv.offsetHeight;
  var targetwidth = targetdiv.offsetWidth;
  var topposition = topPosition(targetdiv) - ((msgheight - targetheight) / 2);
  var leftposition = leftPosition(targetdiv) + targetwidth + MSGOFFSET;
  msg.style.top = topposition + 'px';
  msg.style.left = leftposition + 'px';
  clearInterval(msg.timer);
  msg.timer = setInterval("fadeMsg(1)", MSGTIMER);
  if(!autohide) {
    autohide = MSGHIDE;  
  }
  window.setTimeout("hideMsg()", (autohide * 1000));
}

// hide the form alert //
function hideMsg(msg) {
  var msg = document.getElementById('msg');
  if(!msg.timer) {
    msg.timer = setInterval("fadeMsg(0)", MSGTIMER);
  }
}

// face the message box //
function fadeMsg(flag) {
  if(flag == null) {
    flag = 1;
  }
  var msg = document.getElementById('msg');
  var value;
  if(flag == 1) {
    value = msg.alpha + MSGSPEED;
  } else {
    value = msg.alpha - MSGSPEED;
  }
  msg.alpha = value;
  msg.style.opacity = (value / 100);
  msg.style.filter = 'alpha(opacity=' + value + ')';
  if(value >= 99) {
    clearInterval(msg.timer);
    msg.timer = null;
  } else if(value <= 1) {
    msg.style.display = "none";
    clearInterval(msg.timer);
  }
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
  var left = 0;
  if(target.offsetParent) {
    while(1) {
      left += target.offsetLeft;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.x) {
    left += target.x;
  }
  return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
  var top = 0;
  if(target.offsetParent) {
    while(1) {
      top += target.offsetTop;
      if(!target.offsetParent) {
        break;
      }
      target = target.offsetParent;
    }
  } else if(target.y) {
    top += target.y;
  }
  return top;
}

// preload the arrow //
if(document.images) {
  arrow = new Image(7,80); 
  arrow.src = "../images/msg_arrow.gif"; 
}