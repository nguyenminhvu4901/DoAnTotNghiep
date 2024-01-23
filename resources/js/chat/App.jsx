import ReactDOM from 'react-dom/client';
import ChatUser from './pages/ChatUser';
import ChatAdmin from './pages/ChatAdmin';

if (document.getElementById('chat')) {
    const main = ReactDOM.createRoot(document.getElementById('chat'));

    main.render(<ChatUser />);
}

if (document.getElementById('chat-admin')) {
    const main = ReactDOM.createRoot(document.getElementById('chat-admin'));

    main.render(<ChatAdmin />);
}
