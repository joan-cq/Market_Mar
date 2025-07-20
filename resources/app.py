import rembg
from PIL import Image
import tkinter as tk
from tkinter import filedialog

def remove_background(input_path, output_path):
    # Abrir la imagen original
    input_image = Image.open(input_path)
    
    # Quitar el fondo
    output_image = rembg.remove(input_image)
    
    # Guardar la imagen sin fondo
    output_image.save(output_path)

def select_image():
    # Seleccionar imagen de entrada
    input_path = filedialog.askopenfilename(title="Selecciona una imagen", filetypes=[("Archivos de imagen", "*.jpg *.jpeg *.png")])
    
    if input_path:
        # Seleccionar ruta de guardado
        output_path = filedialog.asksaveasfilename(title="Guardar imagen como", defaultextension=".png", filetypes=[("Archivos PNG", "*.png")])
        
        if output_path:
            remove_background(input_path, output_path)
            print(f"Fondo eliminado y guardado en: {output_path}")

# Interfaz gráfica simple
root = tk.Tk()
root.title("Quitar fondo de imagen")

select_button = tk.Button(root, text="Seleccionar imagen", command=select_image)
select_button.pack(pady=20)

root.mainloop()
