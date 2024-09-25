import React from 'react'
import ReactDOM from 'react-dom/client'

export function Example() {
    return (
        <div>HI</div>
    );
}


if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
