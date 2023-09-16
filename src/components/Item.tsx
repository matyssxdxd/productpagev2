import React, { ChangeEvent } from 'react'
import { Product } from '../pages/Home'
import "./Item.css";

interface ItemProps {
    product: Product;
    onChange: (itemId: string, isChecked: boolean) => void;
  }

function Item({product, onChange}: ItemProps) {

    const { sku, name, price, size, weight, height, width, length } = product;

    const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
        const {id, checked} = event.target;
        onChange(id, checked);
    }

  return (
    <div className='item'>
        <input type="checkbox" id={sku} className="delete-checkbox" onChange={handleChange} />
        <p>{sku}</p>
        <p>{name}</p>
        <p>{price}.00 $</p>
        {size !== null && <p>Size: {size} MB</p>}
        {weight !== null && <p>Weight: {weight}KG</p>}
        {height !== null && width !== null && length !== null && (
            <p>
            Dimensions: {height}x{width}x{length}
            </p>
        )}
    </div>
  )
}

export default Item