import { Box, Grid, IconButton, TextField, styled } from '@mui/material';
import MinimizeIcon from '@mui/icons-material/Minimize';
import SendIcon from '@mui/icons-material/Send';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import Messages from '../modules/Messages';
import { useEffect, useState } from 'react';
import CancelOutlinedIcon from '@mui/icons-material/CancelOutlined';
import FilterNoneOutlinedIcon from '@mui/icons-material/FilterNoneOutlined';
import { red } from '@mui/material/colors';

const Container = styled(Box)({
    backgroundColor: '#75d8f9',
    height: '500px',
    width: '450px',
    position: 'absolute',
    bottom: 0,
    right: '10%',
    borderRadius: '15px 15px 0 0',
    '& .minimized': {
        height: '40px',
        '& .header-chat': {
            height: '40px',
        },
        '& .content-chat, .footer-chat': {
            height: 0,
            padding: 0,
            minHeight: 0,
            maxHeight: 0,
            overflow: 'hidden',
        },
    },
    transition: 'height 0.3s ease-in-out',
});

const HeaderContainer = styled(Box)({
    height: '8%',
    width: '100%',
    textAlign: 'end',
    padding: '0px 15px 0px 15px',
    borderBottom: '1px solid',
    '& .icon': {
        width: '15px',
        height: '15px',
        marginBottom: '-20px',
        cursor: 'pointer',
    },
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
    padding: '10px 15px 0 15px',
    borderTop: '1px solid',
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'flex-start',
    justifyContent: 'flex-end',
});

const VisuallyHiddenInput = styled('input')({
    clip: 'rect(0 0 0 0)',
    clipPath: 'inset(50%)',
    height: 1,
    overflow: 'hidden',
    position: 'absolute',
    bottom: 0,
    left: 0,
    whiteSpace: 'nowrap',
    width: 1,
});

const ContainerPreview = styled(Box)({
    position: 'relative',
    display: 'inline-block',
    paddingTop: '10px',
    maxWidth: '85%',
    '& .file-name': {
        color: '#000',
        width: '100%',
        overflow: 'hidden',
        textOverflow: 'ellipsis',
        whiteSpace: 'nowrap',
    },
});

const PreviewImage = styled('img')({
    maxHeight: '50px',
    maxWidth: '65px',
});

const RemoveFile = styled(CancelOutlinedIcon)({
    position: 'absolute',
    top: '1%',
    right: '-15%',
    cursor: 'pointer',
});

function ChatUser() {
    const [message, setMessage] = useState('');
    const [file, setFile] = useState(null);
    const [imagePreviewUrl, setImagePreviewUrl] = useState(null);
    const [openChat, setOpenChat] = useState(false);

    useEffect(() => {
        if (openChat) {
            closeBoxChat();
            return;
        }
        openBoxChat();
    }, [openChat]);

    const handleChangeInput = (e) => {
        setMessage(e.target.value);
    };

    const handleChangeFile = (e) => {
        const file = e.target.files[0];
        setImagePreviewUrl(null);
        setFile(file);

        if (file && file.type.startsWith('image/')) {
            const tempUrl = URL.createObjectURL(file);
            setImagePreviewUrl(tempUrl);
        }
    };

    const handleDeleteFile = () => {
        setFile(null);
        setImagePreviewUrl(null);
    };

    const handleOpenChat = () => {
        setOpenChat(!openChat);
    };

    const openBoxChat = () => {
        const boxChat = document.getElementById('box-chat');
        const headerChat = document.getElementById('header-chat');
        const contentChat = document.getElementById('content-chat');
        const footerChat = document.getElementById('footer-chat');

        boxChat.style.height = '500px';
        headerChat.style.height = '8%';
        contentChat.style.display = 'block';
        footerChat.style.display = 'flex';
    };

    const closeBoxChat = () => {
        const boxChat = document.getElementById('box-chat');
        const headerChat = document.getElementById('header-chat');
        const contentChat = document.getElementById('content-chat');
        const footerChat = document.getElementById('footer-chat');

        boxChat.style.height = '40px';
        headerChat.style.height = '40px';
        contentChat.style.display = 'none';
        footerChat.style.display = 'none';
    };

    return (
        <Container id="box-chat">
            <HeaderContainer id="header-chat">
                {!openChat ? (
                    <MinimizeIcon className="icon" onClick={handleOpenChat} />
                ) : (
                    <FilterNoneOutlinedIcon className="icon" onClick={handleOpenChat} />
                )}
            </HeaderContainer>
            <ContentContainer id="content-chat">
                <Messages />
            </ContentContainer>
            <FooterContainer id="footer-chat">
                {file && (
                    <ContainerPreview>
                        {imagePreviewUrl ? (
                            <PreviewImage src={imagePreviewUrl} alt="Preview" />
                        ) : (
                            <p className="file-name">{file.name}</p>
                        )}
                        <RemoveFile sx={{ color: red[500] }} fontSize="small" onClick={handleDeleteFile} />
                    </ContainerPreview>
                )}

                <Grid container direction="row" justifyContent="center" alignItems="center">
                    <Grid item xs={10}>
                        <TextField
                            label="Message"
                            variant="outlined"
                            sx={{ width: '100%' }}
                            multiline
                            maxRows={2}
                            value={message}
                            onChange={handleChangeInput}
                        />
                    </Grid>
                    <Grid item xs={2} style={{ textAlign: 'center' }}>
                        <IconButton component="label">
                            <CloudUploadIcon />
                            <VisuallyHiddenInput type="file" onChange={handleChangeFile} />
                        </IconButton>
                        <IconButton color="info" disabled={!message && !file}>
                            <SendIcon />
                        </IconButton>
                    </Grid>
                </Grid>
            </FooterContainer>
        </Container>
    );
}

export default ChatUser;
