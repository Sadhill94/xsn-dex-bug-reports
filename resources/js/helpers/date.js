import moment from 'moment';

export const formatDate = (value, format = 'DD MMM - YYYY') => {
  // console.log('value', value);
  // const ku = moment(value);
  // console.log(ku);
  // console.log('valid', ku.isValid());
  // console.log(ku.format(format));
  return value ? moment(value).format(format) : '';
};
