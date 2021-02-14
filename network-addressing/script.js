function maxLengthCheck(object, maxLength) {
  if (object.value.length > maxLength)
    object.value = object.value.slice(0, maxLength);
}
