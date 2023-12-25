import { Avatar, Box, styled } from '@mui/material';

const MessageContainer = styled(Box)({
    width: '100%',
});

const MyMessage = styled(Box)({
    width: '100%',
    '& .container-message': {
        width: 'max-content',
        '& .message': {
            padding: '10px 15px 10px 10px',
            borderRadius: '10px',
            backgroundColor: 'white',
        },

        '& .time-send': {
            textAlign: 'end',
        },
    },
});

const OtherMessage = styled(Box)({
    width: '100%',
    '& .container-message': {
        width: 'max-content',
        '& .owner': {},
        '& .message': {
            padding: '10px 15px 10px 10px',
            borderRadius: '10px',
            backgroundColor: 'yellow',
            with: '100%',
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
                <Box className="container-message">
                    <div className="message my-1">Messages Content</div>
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
                        <span className="name-owner mx-2">Name Owner</span>
                    </div>
                    <div className="message my-1">Messages Content</div>
                    <div className="time-send">25/12/23 16:04</div>
                </Box>
            </OtherMessage>
        );
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
