import { Box, styled } from '@mui/material';
import Message from '../components/Message';

const BoxMessages = styled(Box)({
    height: '100%',
});

function Messages() {
    const data = [
        {
            id: 1,
            name: 'vumn',
            type: 'text',
            message: 'Message Content',
            owner: false,
        },
        {
            id: 2,
            name: 'vumn',
            type: 'text',
            message: 'Message Content',
            owner: true,
        },
        {
            id: 3,
            name: 'vumn',
            type: 'text',
            message:
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            owner: false,
        },
        {
            id: 4,
            name: 'vumn',
            type: 'text',
            message:
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            owner: true,
        },
        {
            id: 5,
            name: 'vumn',
            type: 'image',
            message:
                'https://buffer.com/cdn-cgi/image/w=1000,fit=contain,q=90,f=auto/library/content/images/size/w1200/2023/10/free-images.jpg',
            owner: true,
        },
        {
            id: 6,
            name: 'vumn',
            type: 'image',
            message:
                'https://buffer.com/cdn-cgi/image/w=1000,fit=contain,q=90,f=auto/library/content/images/size/w1200/2023/10/free-images.jpg',
        },
        {
            id: 7,
            name: 'vumn',
            type: 'file',
            message: 'demo-file.txt',
            owner: true,
        },
        {
            id: 8,
            name: 'vumn',
            type: 'file',
            message: 'demo-file.txt',
        },
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
