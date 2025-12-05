export function currencyFormat(number) {
    return number.toLocaleString("id-ID", {
        style: "currency",
        currency: "IDR",
    });
}

export function imageUrl(url) {
    if (url.match(/^http/)) {
        return url;
    }
    return "/storage/" + url;
}
export function breakWord(text, maxLength = 100, ellipsis = "...") {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + ellipsis;
    }
    return text;
}
export function routeUrl(type, slug) {
    switch (type) {
        case "post":
            return "/" + slug;
        case "category":
            return "/category/" + slug;
        case "tag":
            return "/tag/" + slug;
        case "author":
            return "/author/" + slug;
        default:
            return "/";
    }
}
export function stripTags(str) {
    return str.replace(/<\/?[^>]+(>|$)/g, "");
}
export function excerpt(text, length = 150) {
    const clean = stripTags(text);
    return clean.length > length ? clean.slice(0, length) + "..." : clean;
}
export function slugify(str) {
    return str
        .toLowerCase()
        .replace(/[^\w ]+/g, "")
        .replace(/ +/g, "-");
}
export function formatDate(date, locale = "id-ID") {
    return new Date(date).toLocaleDateString(locale, {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}
export function timeAgo(date) {
    const d = new Date(date);
    const now = new Date();
    const diff = (now - d) / 1000;

    if (diff < 60) return "baru saja";
    if (diff < 3600) return Math.floor(diff / 60) + " menit lalu";
    if (diff < 86400) return Math.floor(diff / 3600) + " jam lalu";
    if (diff < 604800) return Math.floor(diff / 86400) + " hari lalu";
    return formatDate(date);
}

export function parseCategory(labels) {
    return labels
        .filter((label) => label.taxonomy === "category")
        .map((label) => label.name)[0];
}
export function parseTagString(labels) {
    return labels
        .filter((label) => label.taxonomy === "tag")
        .map((label) => label.name)
        .join(", ");
}
export function parseTagArray(labels) {
    return labels
        .filter((label) => label.taxonomy === "tag")
        .map((label) => label.name);
}
export function dateFormatHuman(date) {
    return new Date(date).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
    });
}
