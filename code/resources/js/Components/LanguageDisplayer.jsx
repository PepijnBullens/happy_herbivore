export default function LanguageDisplayer({ language, words }) {
    return language === "english" || !language
        ? words.english
        : language === "dutch"
        ? words.dutch
        : words.german;
}
