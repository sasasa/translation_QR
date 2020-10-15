export function hashBytes(i32) {
  return [
      (i32 & 0xFF000000) >>> 24,
      (i32 & 0x00FF0000) >>> 16,
      (i32 & 0x0000FF00) >>> 8,
      (i32 & 0x000000FF) >>> 0,
  ];
}
function toHex(b) {
  let str = b.toString(16);
  if (2 <= str.length) {
      return str;
  }

  return "0" + str;
}
export function toColorCode(bytes) {
  return "#" + toHex(bytes[0]) + toHex(bytes[1]) + toHex(bytes[2]);
}
export function brightness(r, g, b) {
  return Math.floor(((r * 299) + (g * 587) + (b * 114)) / 1000);
}