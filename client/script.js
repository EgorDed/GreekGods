async function loadSchema() {
    try {
        const response = await fetch('http://greekgods.ru/api/v1/final/', {
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }

        const data = await response.json(); // <-- получаем JSON
        const dotContent = data.content;        // <-- берём поле dot

        console.log(dotContent);

        // Рендерим DOT через d3-graphviz
        d3.select("#graph")
            .graphviz()
            .renderDot(dotContent);

    } catch (error) {
        document.getElementById('graph').innerHTML =
            `Error: ${error.message}<br><a href="/schema.dot">View DOT source</a>`;
    }
}

loadSchema();
