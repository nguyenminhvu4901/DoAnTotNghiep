import ReactDOM from 'react-dom/client';

if (document.getElementById('chat')) {
    const main = ReactDOM.createRoot(document.getElementById('chat'));

    main.render(<h2>Chat</h2>);
}
