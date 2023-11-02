
export const cutString = (text, maxLength = 30) => {
    if (text.length > maxLength) {
        return text.slice(0, maxLength) + '...';
    } else {
        return text;
    }
}

export const copyText = (textToCopy) => {
    const textArea = document.createElement("textarea");
    textArea.value = textToCopy;
    document.body.appendChild(textArea);

    textArea.select();

    try {
        document.execCommand("copy");
    } catch (err) {
        console.error("Unable to copy text: ", err);
    }

    document.body.removeChild(textArea);
}