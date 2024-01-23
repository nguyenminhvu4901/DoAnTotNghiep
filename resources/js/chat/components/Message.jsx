import { Avatar, Box, styled } from '@mui/material';
import FileMessage from './FileMessage';
import ImageMessage from './ImageMessage';

const MessageContainer = styled(Box)({
    width: '100%',
});

const MyMessage = styled(Box)({
    width: '100%',
    '& .message': {
        maxWidth: '100%',
        width: 'max-content',
        '& .content': {
            padding: '10px 15px 10px 10px',
            borderRadius: '10px',
            backgroundColor: 'white',
            '& .text-message': {
                color: 'black',
                margin: 0,
            },
        },

        '& .time-send': {
            textAlign: 'start',
        },
    },
});

const OtherMessage = styled(Box)({
    width: '100%',
    '& .container-message': {
        '& .owner': {},
        '& .message': {
            maxWidth: '100%',
            width: 'max-content',
            maxWidth: '100%',
            '& .content': {
                padding: '10px 15px 10px 10px',
                borderRadius: '10px',
                backgroundColor: 'yellow',
                '& .text-message': {
                    color: 'black',
                    margin: 0,
                },
            },
        },
        '& .time-send': {
            textAlign: 'end',
        },
    },
});

function Message({ message }) {
    const myMessage = () => {
        return (
            <MyMessage className="d-flex flex-row justify-content-end">
                <Box className="message">
                    <div className="content my-1">{contentMessage()}</div>
                    <div className="time-send">25/12/23 16:04</div>
                </Box>
            </MyMessage>
        );
    };

    const otherMessage = () => {
        return (
            <OtherMessage>
                <Box className="container-message">
                    <div className="owner d-flex align-items-center">
                        <Avatar alt="owner avatar" src="/static/images/avatar/1.jpg" className="avatar-owner" />
                        <span className="name-owner mx-2">{message.name}</span>
                    </div>
                    <div className="message">
                        <div className="content my-1">{contentMessage()}</div>
                        <div className="time-send">25/12/23 16:04</div>
                    </div>
                </Box>
            </OtherMessage>
        );
    };

    const contentMessage = () => {
        switch (message.type) {
            case 'file':
                return <FileMessage file={message.message} />;
            case 'image':
                return <ImageMessage url={message.message} />;
            default:
                return <p className="text-message">{message.message}</p>;
        }
    };

    return (
        <>
            {message && (
                <MessageContainer className="my-3">{message.owner ? otherMessage() : myMessage()}</MessageContainer>
            )}
        </>
    );
}

export default Message;
