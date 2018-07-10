<title><?= $title ?></title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<style>
    .loader {
        display: inline-block;
        border: 13px solid #f3f3f3;
        border-top: 13px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    h3.title {
        font-size: 18px;
    }

    cite.url {
        color: #006621;
        font-style: normal;
        font-size 15px;
    }

    p.description {
        font-size: 14px;
    }
</style>