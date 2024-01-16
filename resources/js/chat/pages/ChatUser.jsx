import { Box, TextField, styled } from '@mui/material';
import MinimizeIcon from '@mui/icons-material/Minimize';
import SendIcon from '@mui/icons-material/Send';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import Messages from '../modules/Messages';

const Container = styled(Box)({
    backgroundColor: '#75d8f9',
    height: '500px',
    width: '450px',
    position: 'absolute',
    bottom: 0,
    right: '10%',
    borderRadius: '15px 15px 0 0',
});

const HeaderContainer = styled(Box)({
    height: '8%',
    width: '100%',
    textAlign: 'end',
    padding: '0px 15px 15px 15px',
    borderBottom: '1px solid',
});

const ContentContainer = styled(Box)({
    minHeight: '325px',
    height: '65%',
    width: '100%',
    padding: '15px',
    overflowY: 'scroll',
});

const FooterContainer = styled(Box)({
    height: '27%',
    width: '100%',
    padding: '15px',
    borderTop: '1px solid',
});

function ChatUser() {
    return (
        <Container>
            <HeaderContainer>
                <MinimizeIcon style={{ cursor: 'pointer' }} />
            </HeaderContainer>
            <ContentContainer>
                <Messages />
            </ContentContainer>
            <FooterContainer>
                <TextField label="Message" variant="outlined" />
                <CloudUploadIcon style={{ cursor: 'pointer' }} />
                <SendIcon style={{ cursor: 'pointer' }} color="info" />
            </FooterContainer>
        </Container>
    );
}

export default ChatUser;
