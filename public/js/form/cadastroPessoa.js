const params = new URLSearchParams(window.location.search);
const idpessoa = params.get('idpessoa');

if (idpessoa) {
    document.getElementById('tituloForm').innerText = "Alterar Pessoa";
    fetch(`/magazord/src/controller/PessoaController.php?acao=buscar&idpessoa=${idpessoa}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('idpessoa').value = data.idpessoa;
            document.getElementById('nomepessoa').value = data.nomepessoa;
            document.getElementById('cpfpessoa').value = data.cpfpessoa;
        });
}

document.getElementById('formPessoa').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('nomepessoa', document.getElementById('nomepessoa').value);
    formData.append('cpfpessoa', document.getElementById('cpfpessoa').value);

    let url, acao;
    if (idpessoa) {
        formData.append('idpessoa', idpessoa);
        url = '/magazord/src/controller/PessoaController.php?acao=alterar';
    } else {
        url = '/magazord/src/controller/PessoaController.php?acao=inserir';
    }
    console.log(url);
    fetch(url, { method: 'POST', body: formData })
        .then(() => window.location.href = '/magazord/public/pessoa.html');
});