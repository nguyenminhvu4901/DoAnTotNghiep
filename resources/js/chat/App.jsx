import ReactDOM from 'react-dom/client';
import ChatUser from './pages/ChatUser';

if (document.getElementById('chat')) {
    const main = ReactDOM.createRoot(document.getElementById('chat'));

    main.render(<ChatUser />);
}
