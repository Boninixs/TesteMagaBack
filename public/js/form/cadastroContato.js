const params = new URLSearchParams(window.location.search);
const idcontato = params.get('idcontato');
const idpessoa = params.get('idpessoa');

if (idcontato) {
    document.getElementById('tituloForm').innerText = "Alterar Contato";
    fetch(`/magazord/src/controller/ContatoController.php?acao=buscar&idcontato=${idcontato}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('idcontato').value = data.idcontato;
            document.getElementById('idpessoa').value = data.idpessoa;
            document.getElementById('tipocontato').value = data.tipocontato;
            document.getElementById('descricaocontato').value = data.descricaocontato;
        });
}else{
    if(idpessoa){
        document.getElementById('idpessoa').value = idpessoa;
    }
}

document.getElementById('formContato').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('idpessoa', document.getElementById('idpessoa').value);
    formData.append('tipocontato', document.getElementById('tipocontato').value);
    formData.append('descricaocontato', document.getElementById('descricaocontato').value);

    let url;
    if (idcontato) {
        formData.append('idcontato', idcontato);
        url = '/magazord/src/controller/ContatoController.php?acao=alterar';
    } else {
        url = '/magazord/src/controller/ContatoController.php?acao=inserir';
    }

    fetch(url, { method: 'POST', body: formData })
        .then(() => window.location.href = `/magazord/public/contato.html?idpessoa=${document.getElementById('idpessoa').value}`);
});