function formLoginCancel(email, password) {
   email.value = "";
   password.value = "";
}
function formLoginHash(form, password) {
   // Crea un elemento di input che verrà usato come campo di output per la password criptata.
   var p = document.createElement("input");
   // Aggiungi un nuovo elemento al tuo form.
   form.appendChild(p);
   p.name = "crypt_pwd";
   p.type = "hidden";
   p.value = hex_sha512(password.value);
   // Assicurati che la password non venga inviata in chiaro.
   password.value = "";
   // Come ultimo passaggio, esegui il 'submit' del form.
   form.submit();
}
function formRegisterHash(form, pwd, cpwd) { 
   // Crea un elemento di input che verrà usato come campo di output per la password criptata.
   if(pwd.value === "" || cpwd.value === "") {
     alert("Attenzione! I campi password non possono essere vuoti");
     return;
   }
   var p = document.createElement("input");
   var cp = document.createElement("input");
   // Aggiungi un nuovo elemento al tuo form.
   form.appendChild(p);
   form.appendChild(cp);
   p.name = "crypt_pwd";
   p.type = "hidden";
   p.value = hex_sha512(pwd.value);
   cp.name = "crypt_cpwd";
   cp.type = "hidden";
   cp.value = hex_sha512(cpwd.value);
   // Assicurati che la password non venga inviata in chiaro.
   pwd.value = "";
   cpwd.value = "";
   // Come ultimo passaggio, esegui il 'submit' del form.
   form.submit();
} 
function formResetHash(form, pwd, cpwd) { 
   // Crea un elemento di input che verrà usato come campo di output per la password criptata.
   if(pwd.value === "" || cpwd.value === "") {
     alert("Attenzione! I campi password non possono essere vuoti");
     return;
   }
   var p = document.createElement("input");
   var cp = document.createElement("input");
   // Aggiungi un nuovo elemento al tuo form.
   form.appendChild(p);
   form.appendChild(cp);
   p.name = "crypt_pwd";
   p.type = "hidden";
   p.value = hex_sha512(pwd.value);
   cp.name = "crypt_cpwd";
   cp.type = "hidden";
   cp.value = hex_sha512(cpwd.value);
   // Assicurati che la password non venga inviata in chiaro.
   pwd.value = "";
   cpwd.value = "";
   // Come ultimo passaggio, esegui il 'submit' del form.
   form.submit();
} 