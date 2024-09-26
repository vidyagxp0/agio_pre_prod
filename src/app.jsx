import React from 'react'
import ReactDOM from 'react-dom/client'

export function Example() {
    return (
        <div className='card my-4'>HI asd</div>
    );
}

if (document.getElementById('rootApp')) {
    const Index = ReactDOM.createRoot(document.getElementById("rootApp"));

    Index.render(
        <React.StrictMode>
            <Example/>
        </React.StrictMode>
    )
}
