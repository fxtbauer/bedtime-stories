// Validação em tempo real de senha e confirmação
const form = document.getElementById('form-register');
const pwd = document.getElementById('password');
const pwdConf = document.getElementById('passwordConfirm');
const invalidPwd = document.querySelector('.validPwd');
const invalidConf = document.querySelector('.validConf');

// Regra: >= 8 chars | apenas letras e números
const pwdValid = (s) => /^[A-Za-z0-9]{8,}$/.test(s);

function touchValidState(input, isValid) {
  input.classList.remove('is-valid', 'is-invalid', 'blink-valid', 'blink-invalid');
  if (isValid) {
    input.classList.add('is-valid', 'blink-valid');
  } else {
    input.classList.add('is-invalid', 'blink-invalid');
  }
}

function validatePassword() {
  const ok = pwdValid(pwd.value);
  invalidPwd.classList.toggle('show-error', !ok);
  touchValidState(pwd, ok);
  return ok;
}

function validateConfirm() {
  const ok = pwd.value.length > 0 && pwd.value === pwdConf.value;
  invalidConf.classList.toggle('show-error', !ok);
  touchValidState(pwdConf, ok);
  return ok;
}

pwd.addEventListener('input', () => {
  validatePassword();
  // se a senha muda, revalida confirmação
  if (pwdConf.value.length) validateConfirm();
});

pwdConf.addEventListener('input', validateConfirm);

form.addEventListener('submit', (e) => {
  const okPwd = validatePassword();
  const okConf = validateConfirm();

  // bloqueia envio se algo inválido
  if (!okPwd || !okConf) {
    e.preventDefault();
  }
});
