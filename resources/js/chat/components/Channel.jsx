import { Avatar, Box, styled } from '@mui/material';

const Container = styled(Box)({
    padding: '5px 0 5px 10px',
    height: '70px',
    width: '100%',
    cursor: 'pointer',
    display: 'flex',
    flexDirection: 'row',
    flexWrap: 'nowrap',
    alignItems: 'center',
    justifyContent: 'flex-start',
    color: '#000',
    '&:hover': {
        backgroundColor: '#321fdb',
        borderRadius: '6px',
        color: '#fff',
    },
});

const BoxImage = styled(Box)({
    marginRight: '15px',
});

const BoxChannel = styled(Box)({
    '& .channel-name': {
        fontSize: '18px',
        fontWeight: '500',
        whiteSpace: 'nowrap',
        overflow: 'hidden',
        textOverflow: 'ellipsis',
        maxWidth: '200px',
    },
    '& .channel-content': {
        display: 'flex',
        flexDirection: 'row',
        fontSize: '12px',
        '& .content': {
            maxWidth: '140px',
            marginRight: '15px',
            whiteSpace: 'nowrap',
            overflow: 'hidden',
            textOverflow: 'ellipsis',
        },
    },
});

function Channel({ channel }) {
    return (
        <Container>
            <BoxImage>
                <Avatar alt="owner avatar" src="/static/images/avatar/1.jpg" className="avatar-owner" />
            </BoxImage>
            <BoxChannel>
                <div className="channel-name">{channel.name}</div>
                <div className="channel-content">
                    <span className="content">content message</span>
                    <span className="time">21 giờ</span>
                </div>
            </BoxChannel>
        </Container>
    );
}

export default Channel;
