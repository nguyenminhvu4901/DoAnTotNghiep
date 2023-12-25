import { Box, styled } from '@mui/material';
import Message from '../components/Message';

const BoxMessages = styled(Box)({
    height: '100%',
});

function Messages() {
    const data = [
        { id: 1, name: 'vumn', message: 'Message Content', owner: false },
        { id: 2, name: 'vumn', message: 'Message Content', owner: true },
        { id: 3, name: 'vumn', message: 'Message Content', owner: false },
        { id: 4, name: 'vumn', message: 'Message Content', owner: true },
        { id: 5, name: 'vumn', message: 'Message Content', owner: false },
        { id: 6, name: 'vumn', message: 'Message Content', owner: true },
    ];

    return (
        <BoxMessages>
            {data.map((message) => (
                <Message message={message} key={message.id} />
            ))}
        </BoxMessages>
    );
}

export default Messages;
