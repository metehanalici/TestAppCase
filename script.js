document.addEventListener("DOMContentLoaded", () => {
    // Select the form and response div
    const responseDiv = document.getElementById("response");

    // Function to get URL parameters
    function getUrlParams() {
        const params = {};
        const queryString = window.location.search.substring(1);
        const vars = queryString.split("&");
        for (let i = 0; i < vars.length; i++) {
            const pair = vars[i].split("=");
            params[pair[0]] = decodeURIComponent(pair[1]);
        }
        return params;
    }

    // Get URL parameters and display them
    const params = getUrlParams();
    if (params.name && params.email && params.message) {
        responseDiv.innerHTML = `
            <p><strong>Name:</strong> ${params.name}</p>
            <p><strong>Email:</strong> ${params.email}</p>
            <p><strong>Message:</strong> ${params.message}</p>
        `;
    }
});
