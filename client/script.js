async function loadSchema() {
    try {
        const response = await fetch('/schema.dot');
        const dotContent = await response.text();

        // Рендерим с d3-graphviz
        d3.select("#graph").graphviz()
            .renderDot(dotContent);

    } catch (error) {
        document.getElementById('graph').innerHTML =
            `Error: ${error.message}<br><a href="/schema.dot">View DOT source</a>`;
    }
}

loadSchema();