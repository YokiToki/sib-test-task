<html>
<head>
    <?php include('layouts/head.php') ?>
</head>
<body>
<div class="container">
    <h1 class="text center"><?= $title ?></h1>

    <hr>

    <form id="search">
        <div class="input-group">
            <input name="query" type="text" class="form-control" placeholder="Your search request..."
                   aria-label="Your search request...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary" type="button">Search</button>
            </div>
        </div>
    </form>

    <hr>

    <ul class="list-group" id="results">
        <li class="list-group-item">
            <h3 class="title text-center">
                Nothing to show :(
            </h3>
        </li>
    </ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector('form#search'),
            results = document.querySelector('#results');


        function loader() {
            let item = document.createElement('li'),
                loader = document.createElement('div');
            item.className = 'list-group-item text-center';
            loader.className = 'loader';
            item.appendChild(loader);

            return item;
        }

        function item(el) {
            let item = document.createElement('li'),
                h3 = document.createElement('h3'),
                a = document.createElement('a'),
                cite = document.createElement('cite'),
                p = document.createElement('p');

            h3.className = 'title';
            a.innerText = el.title;
            a.href = el.url;
            a.target = '_blank';
            h3.appendChild(a);
            cite.className = 'url';
            cite.innerText = el.url;
            p.className = 'description';
            p.innerText = el.description;
            item.className = 'list-group-item';
            item.appendChild(h3);
            item.appendChild(cite);
            item.appendChild(p);

            return item;
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let i,
                query = e.target.query.value;

            results.innerHTML = '';
            results.appendChild(loader());

            fetch('/api/search/' + query)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    results.innerHTML = '';
                    data.forEach(el => {
                        i = item(el);
                        results.appendChild(i);
                    })
                })
                .catch(console.error);
        });
    });
</script>
</body>
</html>